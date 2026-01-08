<?php

namespace App\DataTables;

use App\Models\ServingCity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServingCityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->editColumn('city_name', function ($c) {
                return city_label($c->city_name);
            })

            ->addColumn('created_by', fn($c) => optional($c->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($c) => optional($c->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($c) => Carbon::parse($c->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($c) => $c->updated_at ? Carbon::parse($c->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'serving_cities.created_at $1')
            ->orderColumn('updated_at', 'serving_cities.updated_at $1')

            ->editColumn('is_active', function ($c) {
                if ($c->is_active == 1) {
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


            ->editColumn('city_image', function ($c) {
                if (!$c->city_image) {
                    return '-';
                }

                $url = asset('storage/cities/' . $c->city_image);

                return '<img src="' . $url . '" alt="Thumbnail" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->addColumn('action', fn($c) => view('pages.serving_cities._actions', compact('c'))->render())
            ->rawColumns(['action', 'city_image', 'is_active', 'show_on_header'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ServingCity $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('servingcity-table')
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
            Column::make('city_name')->title('City Name'),
            Column::make('area_name')->title('Area Name'),
            // Column::make('hero_title')->title('Hero Title'),
            Column::make('slug')->title('Slug'),

            Column::make('is_active')->title('Status'),
            Column::make('show_on_header')->title('Show On header'),

            Column::make('created_by')->title('Created By'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_by')->title('Updated By'),
            Column::make('updated_at')->title('Updated At'),

            Column::make('city_image')->title('City Image')
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
        return 'ServingCity_' . date('YmdHis');
    }
}
