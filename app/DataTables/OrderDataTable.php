<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('order_id', fn($order) => '<strong>' . $order->order_id . '</strong>')
            ->editColumn('user_id', fn($order) => $order->user?->name ?? $order->first_name . ' ' . $order->last_name)
            ->editColumn('email', fn($order) => $order->email)
            ->editColumn('total', fn($order) => '$' . number_format($order->total, 2))
            ->editColumn('shipping_method', function($order) {
                $badgeClass = match($order->shipping_method) {
                    'standard' => 'badge-light-primary',
                    'pickup' => 'badge-light-success',
                    default => 'badge-light-secondary'
                };
                return '<span class="badge ' . $badgeClass . '">' . ucfirst($order->shipping_method) . '</span>';
            })
            ->editColumn('payment_status', function($order) {
                $badgeClass = match($order->payment_status) {
                    'completed' => 'badge-light-success',
                    'pending' => 'badge-light-warning',
                    'failed' => 'badge-light-danger',
                    'refunded' => 'badge-light-info',
                    default => 'badge-light-secondary'
                };
                return '<span class="badge ' . $badgeClass . '">' . ucfirst($order->payment_status) . '</span>';
            })
            ->editColumn('order_status', function($order) {
                $badgeClass = match($order->order_status) {
                    'delivered' => 'badge-light-success',
                    'shipped' => 'badge-light-info',
                    'processing' => 'badge-light-primary',
                    'pending' => 'badge-light-warning',
                    'cancelled' => 'badge-light-danger',
                    default => 'badge-light-secondary'
                };
                return '<span class="badge ' . $badgeClass . '">' . ucfirst($order->order_status) . '</span>';
            })
            ->editColumn('created_at', fn($order) => Carbon::parse($order->created_at)->format('d-M-Y H:i'))
            ->editColumn('paid_at', fn($order) => $order->paid_at ? Carbon::parse($order->paid_at)->format('d-M-Y H:i') : '-')

            ->addColumn('action', fn($order) => view('pages.orders._actions', compact('order'))->render())
            ->rawColumns(['order_id', 'shipping_method', 'payment_status', 'order_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['user', 'items.product']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(0, 'desc') // Latest first
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
            Column::make('order_id')->title('Order ID')->searchable(true)->orderable(true),
            Column::make('user_id')->title('Customer')->searchable(true)->orderable(false),
            Column::make('email')->title('Email')->searchable(true)->orderable(false),
            Column::make('total')->title('Total')->searchable(false)->orderable(true),
            Column::make('shipping_method')->title('Shipping')->searchable(true)->orderable(false),
            Column::make('payment_status')->title('Payment Status')->searchable(true)->orderable(false),
            Column::make('order_status')->title('Order Status')->searchable(true)->orderable(false),
            Column::make('created_at')->title('Created At')->searchable(false)->orderable(true),
            Column::make('paid_at')->title('Paid At')->searchable(false)->orderable(true),

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
        return 'Orders_' . date('YmdHis');
    }
}
