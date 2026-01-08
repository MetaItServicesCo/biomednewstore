<?php

namespace App\DataTables;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($blog) => optional($blog->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($blog) => optional($blog->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($blog) => Carbon::parse($blog->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($blog) => $blog->updated_at ? Carbon::parse($blog->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'blogs.created_at $1')
            ->orderColumn('updated_at', 'blogs.updated_at $1')

            ->editColumn('image', function ($blog) {
                if (!$blog->image) {
                    return '-';
                }

                $url = asset('storage/blog/images/' . $blog->image);

                return '<img src="' . $url . '" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->editColumn('is_active', function ($offer) {
                if ($offer->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })

            ->addColumn('action', fn($blog) => view('pages.blog._actions', compact('blog'))->render())
            ->rawColumns(['action', 'image', 'is_active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blogs-table')
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
            Column::make('title')->title('Title'),
            Column::make('slug')->title('Slug'),

            Column::make('is_active')->title('Status'),

            Column::make('created_by')->title('Created By'),
            Column::make('created_at')->title('Created At'),
            Column::make('updated_by')->title('Updated By'),
            Column::make('updated_at')->title('Updated At'),

            Column::make('image')->title('Image')
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
        return 'Blogs_' . date('YmdHis');
    }
}
