<?php

namespace App\DataTables;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($c) => optional($c->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($c) => optional($c->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($c) => Carbon::parse($c->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($c) => $c->updated_at ? Carbon::parse($c->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'categories.created_at $1')
            ->orderColumn('updated_at', 'categories.updated_at $1')

            ->editColumn('status', function ($c) {
                if ($c->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })

            ->editColumn('show_on_header', function ($c) {
                if ($c->show_on_header == 1) {
                    return '<span class="badge badge-success">Yes</span>';
                }
                return '<span class="badge badge-danger">No</span>';
            })


            ->addColumn('action', fn($c) => view('pages.categories.columns._actions', compact('c'))->render())
            ->rawColumns(['action', 'status', 'show_on_header'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('categories.*')           // be explicit
            ->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(6, 'desc')
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
            Column::make('name')
                ->title(__('Name'))
                ->name('categories.name'),

            Column::make('slug')
                ->title(__('Slug'))
                ->name('categories.name'),

            Column::make('status')->title('Status'),
            Column::make('show_on_header')->title('Show On header'),

            Column::make('created_by')
                ->title(__('Created By'))
                ->searchable(false),

            Column::make('created_at')
                ->title(__('Created At'))
                ->name('categories.created_at'),

            Column::make('updated_by')
                ->title(__('Updated By'))
                ->searchable(false),

            Column::make('updated_at')
                ->title(__('Updated At'))
                ->name('categories.updated_at'),

            Column::computed('action')
                ->title(__('Actions'))
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-end text-nowrap'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
