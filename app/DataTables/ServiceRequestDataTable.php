<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\ServiceRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('categories', function ($sr) {
                if (empty($sr->categories)) return '-';

                // Get category names from IDs
                $categoryNames = Category::whereIn('id', $sr->categories)
                    ->pluck('name')
                    ->toArray();

                // Return as bullet points
                return '<ul class="mb-0">' . collect($categoryNames)->map(fn($name) => "<li>{$name}</li>")->implode('') . '</ul>';
            })
            ->editColumn('preferred_contact', fn($sr) => ucfirst($sr->preferred_contact)) // first letter caps
            ->editColumn('created_at', fn($sr) => Carbon::parse($sr->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($sr) => $sr->updated_at ? Carbon::parse($sr->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'service_requests.created_at $1')
            ->orderColumn('updated_at', 'service_requests.updated_at $1')

            ->addColumn('action', fn($sr) => view('pages.biomed_services._actions', compact('sr'))->render())
            ->rawColumns(['action', 'categories'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ServiceRequest $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('servicerequest-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(8, 'desc')
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
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('phone')->title('Phone'),
            Column::make('company')->title('Company'),
            Column::make('service')->title('Service'),
            Column::make('categories')->title('Category'),
            Column::make('preferred_contact')->title('Preferred Contact'),
            Column::make('message')->title('Message'),

            Column::make('created_at')->title('Created At'),

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
        return 'ServiceRequest_' . date('YmdHis');
    }
}
