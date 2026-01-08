<?php

namespace App\DataTables;

use App\Models\WhatWeDo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WhatWeDoDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('section_top_title', function ($w) {
                $content = json_decode($w->content, true);
                return $content[1]['title'] ?? '-';
            })

            ->addColumn('section_top_slug', function ($w) {
                $content = json_decode($w->content, true);
                return $content[1]['slug'] ?? '-';
            })

            ->addColumn('created_by', fn($w) => optional($w->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($w) => optional($w->updatedBy)->name ?? '-')


            ->editColumn('bg_image', function ($w) {
                if (!$w->bg_image) {
                    return '-';
                }

                $url = asset('storage/what-we-do/' . $w->bg_image);

                return '<img src="' . $url . '" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->editColumn('created_at', fn($w) => Carbon::parse($w->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($w) => $w->updated_at ? Carbon::parse($w->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'what_we_dos.created_at $1')
            ->orderColumn('updated_at', 'what_we_dos.updated_at $1')

            ->addColumn('action', fn($w) => view('pages.what-we-do._actions', compact('w'))->render())
            ->rawColumns(['action', 'bg_image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WhatWeDo $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('whatwedo-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(3, 'desc')
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
            Column::computed('section_top_title')->title('Title'),
            Column::computed('section_top_slug')->title('Slug'),

            Column::make('created_by')->title('Created By'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_by')->title('Updated By'),
            Column::make('updated_at')->title('Updated At'),

            Column::make('bg_image')->title('BG Image')
                ->searchable(false)->orderable(false),

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
        return 'WhatWeDo_' . date('YmdHis');
    }
}
