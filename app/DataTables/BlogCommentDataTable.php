<?php

namespace App\DataTables;

use App\Models\BlogComment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogCommentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // Show blog title instead of blog_id
            ->addColumn('blog_title', fn ($c) => plainBracketText(optional($c->blog)->title) ?: '-')
            ->addColumn('created_by', fn($c) => optional($c->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($c) => optional($c->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($c) => Carbon::parse($c->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($c) => $c->updated_at ? Carbon::parse($c->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'blog_comments.created_at $1')
            ->orderColumn('updated_at', 'blog_comments.updated_at $1')

            ->editColumn('status', function ($c) {
                if ($c->status == 'pending') {
                    return '<span class="badge badge-warning">Pending</span>';
                } elseif ($c->status == 'approved') {
                    return '<span class="badge badge-success">Approved</span>';
                } else {
                    return '<span class="badge badge-danger">Rejected</span>';
                }
            })
            ->addColumn('action', fn($c) => view('pages.blog._blog_comment_actions', compact('c'))->render())
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogComment $model): QueryBuilder
    {
        return $model->newQuery()->with(['blog', 'createdBy', 'updatedBy']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blogcomment-table')
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
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('blog_title')->title('Blog Title'),

            Column::make('status')->title('Status'),

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
        return 'BlogComment_' . date('YmdHis');
    }
}
