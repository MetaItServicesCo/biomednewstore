<?php

namespace App\DataTables;

use App\Helpers\PageHelper;
use App\Models\Faq;
use App\Models\Faq as ModelsFaq;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $pageLabels = PageHelper::labels();

        return (new EloquentDataTable($query))
            ->editColumn('page_name', function ($faq) use ($pageLabels) {
                return $pageLabels[$faq->page_name] ?? $faq->page_name;
            })

            ->addColumn('created_by', fn($faq) => optional($faq->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($faq) => optional($faq->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($faq) => Carbon::parse($faq->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($faq) => $faq->updated_at ? Carbon::parse($faq->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'faqs.created_at $1')
            ->orderColumn('updated_at', 'faqs.updated_at $1')

            ->addColumn('action', fn($faq) => view('pages.faqs._actions', compact('faq'))->render())
            ->rawColumns(['action', 'page_name'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ModelsFaq $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('faqs-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(4, 'desc')
            ->addTableClass('table table-striped table-row-bordered gy-5 gs-7 border rounded text-gray-700 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->parameters([
                'pageLength' => 25, // Default rows per page
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, 100]],
            ])
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
            Column::make('page_name')->title('Page'),
            Column::make('question')->title('Question'),
            Column::make('answer')->title('Answer'),

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
        return 'Faqs_' . date('YmdHis');
    }
}
