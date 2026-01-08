<?php

namespace App\DataTables;

use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestimonialDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($t) => optional($t->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($t) => optional($t->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($t) => Carbon::parse($t->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($t) => $t->updated_at ? Carbon::parse($t->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'testimonials.created_at $1')
            ->orderColumn('updated_at', 'testimonials.updated_at $1')

            ->editColumn('is_active', function ($t) {
                if ($t->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })
            ->editColumn('image', function ($t) {
                if (!$t->image) {
                    return '-';
                }

                $url = asset('storage/testimonials/' . $t->image);

                return '<img src="' . $url . '" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })
            ->addColumn('action', fn($t) => view('pages.testimonials._actions', compact('t'))->render())
            ->rawColumns(['action', 'is_active', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Testimonial $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('testimonial-table')
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
            Column::make('short_description')->title('Short Description'),
            Column::make('image')->title('Image'),
            Column::make('image_alt')->title('Image Alt'),
            Column::make('rating')->title('Rating'),

            Column::make('is_active')->title('Is Active'),

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
        return 'Testimonial_' . date('YmdHis');
    }
}
