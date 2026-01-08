<?php

namespace App\DataTables;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->editColumn('type', function ($product) {
                if ($product->type == 'for_store') {
                    return '<span class="badge badge-info">For Store</span>';
                } elseif ($product->type == 'for_rent') {
                    return '<span class="badge badge-warning">For Rent</span>';
                } elseif ($product->type == 'both') {
                    return '<span class="badge badge-primary">Both</span>';
                }
            })

            ->addColumn('category_id', fn($product) => optional($product->category)->name ?? '-')
            ->addColumn('created_by', fn($product) => optional($product->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($product) => optional($product->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($product) => Carbon::parse($product->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($product) => $product->updated_at ? Carbon::parse($product->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'products.created_at $1')
            ->orderColumn('updated_at', 'products.updated_at $1')

            ->editColumn('is_active', function ($product) {
                if ($product->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })
            ->editColumn('show_on_header', function ($product) {
                if ($product->show_on_header == 1) {
                    return '<span class="badge badge-success">Yes</span>';
                }
                return '<span class="badge badge-danger">No</span>';
            })

            ->editColumn('thumbnail', function ($product) {
                if (!$product->thumbnail) {
                    return '-';
                }

                $url = asset('storage/products/thumbnails/' . $product->thumbnail);

                return '<img src="' . $url . '" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->addColumn('action', fn($product) => view('pages.products._actions', compact('product'))->render())
            ->rawColumns(['action', 'type', 'thumbnail', 'is_active', 'show_on_header'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        // Join categories table so 'categories.name' is available for searching
        return $model->newQuery()
            ->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(8, 'desc')
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
            Column::make('name')
                ->title(__('Name'))
                ->name('products.name'),

            Column::make('slug')
                ->title(__('Slug'))
                ->name('products.slug'),

            Column::make('category_id')
                ->title(__('Category'))
                ->data('category_name') // Use alias from join
                ->name('categories.name'),

            Column::make('type')
                ->title(__('Type'))
                ->name('products.type'),

            Column::make('is_active')->title('Is Active'),
            Column::make('show_on_header')->title('Show On header'),


            Column::make('created_by')
                ->title(__('Created By'))
                ->searchable(false),

            Column::make('created_at')
                ->title(__('Created At'))
                ->name('products.created_at'),

            Column::make('updated_by')
                ->title(__('Updated By'))
                ->searchable(false),

            Column::make('updated_at')
                ->title(__('Updated At'))
                ->name('products.updated_at'),

            Column::make('thumbnail')->title('Thumbnail')
                ->searchable(false)->orderable(false),

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
        return 'Product_' . date('YmdHis');
    }
}
