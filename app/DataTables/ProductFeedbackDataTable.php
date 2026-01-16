<?php

namespace App\DataTables;

use App\Models\ProductFeedback;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductFeedbackDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('created_at', fn($feedback) => Carbon::parse($feedback->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($feedback) => $feedback->updated_at ? Carbon::parse($feedback->updated_at)->format('d-M-Y') : '-')
            ->editColumn('status', function ($feedback) {
                $status = $feedback->status;
                $badgeClass = match ($status) {
                    'approved' => 'badge-light-success',
                    'rejected' => 'badge-light-danger',
                    default => 'badge-light-warning',
                };
                return '<span class="badge ' . $badgeClass . '">' . ucfirst($status) . '</span>';
            })
            ->orderColumn('created_at', 'product_feedbacks.created_at $1')
            ->orderColumn('updated_at', 'product_feedbacks.updated_at $1')
            ->addColumn('action', fn($feedback) => view('pages.product-feedback._actions', compact('feedback'))->render())
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductFeedback $model): QueryBuilder
    {
        return $model->newQuery()->with('product');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productfeedback-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(7, 'desc')
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
            Column::computed('product.name')->title('Product'),
            Column::make('rating')->title('Rating'),
            Column::make('message')->title('Message'),
            Column::make('status')->title('Status'),
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
        return 'ProductFeedback_' . date('YmdHis');
    }
}