<?php

namespace App\DataTables;

use App\Models\ImportantLink;
use App\Models\ImportantLinks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ImportantLinksDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($i) => optional($i->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($i) => optional($i->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($i) => Carbon::parse($i->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($i) => $i->updated_at ? Carbon::parse($i->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'important_links.created_at $1')
            ->orderColumn('updated_at', 'important_links.updated_at $1')


            ->editColumn('for_page', function ($i) {
                return match ($i->for_page) {
                    'privacy_policy'     => '<span class="badge bg-primary">Privacy Policy</span>',
                    'terms_conditions'   => '<span class="badge bg-info">Terms & Conditions</span>',
                    'disclaimer'         => '<span class="badge bg-warning">Disclaimer</span>',
                    default              => '<span class="badge bg-secondary">Unknown</span>',
                };
            })
            ->editColumn('icon', function ($i) {
                if ($i->icon) {
                    return '<i class="' . $i->icon . ' me-2" style="font-size: 1.5rem;"></i>';
                }
                return '<span class="text-muted">-</span>';
            })
            ->addColumn('action', fn($i) => view('pages.importent-links._actions', compact('i'))->render())
            ->rawColumns(['action', 'for_page', 'icon'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ImportantLinks $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('importantlinks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(4, 'desc')
            ->addTableClass('table table-striped table-row-bordered gy-5 gs-7 border rounded text-gray-700 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->drawCallback(
                "function() {
                    if (typeof KTMenu !== 'undefined') {
                        KTMenu.createInstances();
                    }
                }"
            );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('for_page')->title('Page'),
            Column::make('title')->title('Title'),
            Column::make('subtitle')->title('Sub Title'),
            Column::make('button_text')->title('Button Text'),
            Column::make('icon')->title('Icon'),
            Column::make('created_by')->title('Created By'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_by')->title('Updated By'),
            Column::make('updated_at')->title('Updated At'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ImportantLinks_' . date('YmdHis');
    }
}
