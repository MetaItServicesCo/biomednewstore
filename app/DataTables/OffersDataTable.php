<?php

namespace App\DataTables;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OffersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($offer) => optional($offer->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($offer) => optional($offer->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($offer) => Carbon::parse($offer->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($offer) => $offer->updated_at ? Carbon::parse($offer->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'offers.created_at $1')
            ->orderColumn('updated_at', 'offers.updated_at $1')

            ->editColumn('is_active', function ($offer) {
                if ($offer->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })


            ->editColumn('thumbnail', function ($offer) {
                if (!$offer->thumbnail) {
                    return '-';
                }

                $url = asset('storage/offers/thumbnails/' . $offer->thumbnail);

                return '<img src="' . $url . '" alt="Thumbnail" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->addColumn('action', fn($offer) => view('pages.offers._actions', compact('offer'))->render())
            ->rawColumns(['action', 'thumbnail', 'is_active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Offer $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('offers-table')
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
            // Column::make('id')->title('ID')->addClass('text-center')->width(60),

            Column::make('title')->title('Title'),
            Column::make('slug')->title('Slug'),

            Column::make('is_active')->title('Status'),

            Column::make('created_by')->title('Created By'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_by')->title('Updated By'),
            Column::make('updated_at')->title('Updated At'),

            Column::make('thumbnail')->title('Thumbnail')
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
        return 'Offers_' . date('YmdHis');
    }
}
