<?php

namespace App\DataTables;

use App\Models\RepairServicesSubPage;
use App\Models\RepairServiceSubPage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RepairServicesSubPageDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('created_by', fn($page) => optional($page->createdBy)->name ?? '-')
            ->addColumn('updated_by', fn($page) => optional($page->updatedBy)->name ?? '-')

            ->editColumn('created_at', fn($page) => Carbon::parse($page->created_at)->format('d-M-Y'))
            ->editColumn('updated_at', fn($page) => $page->updated_at ? Carbon::parse($page->updated_at)->format('d-M-Y') : '-')

            // Tell Yajra how to sort these formatted columns
            ->orderColumn('created_at', 'repair_service_sub_pages.created_at $1')
            ->orderColumn('updated_at', 'repair_service_sub_pages.updated_at $1')

            ->addColumn('page_category', function ($page) {
                $categories = [
                    'repair-service' => ['Repairing Services', 'badge-primary'],
                    'x-ray' => ['X Ray', 'badge-info'],
                    'c-arm' => ['C Arm', 'badge-warning'],
                ];

                if (!isset($categories[$page->page_category])) {
                    return '-';
                }

                [$label, $class] = $categories[$page->page_category];

                return '<span class="badge ' . $class . '">' . $label . '</span>';
            })

            ->editColumn('is_active', function ($page) {
                if ($page->is_active == 1) {
                    return '<span class="badge badge-success">Active</span>';
                }
                return '<span class="badge badge-danger">Inactive</span>';
            })

            ->editColumn('thumbnail', function ($page) {
                if (!$page->content_thumbnail) {
                    return '-';
                }

                $url = asset('storage/repair-pages/' . $page->content_thumbnail);

                return '<img src="' . $url . '" alt="Thumbnail" width="60" height="60" style="object-fit: cover; border-radius: 5px;">';
            })

            ->addColumn('action', fn($page) => view('pages.repair-service.sub-pages._actions', compact('page'))->render())
            ->rawColumns(['action', 'thumbnail', 'is_active', 'page_category'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RepairServiceSubPage $model): QueryBuilder
    {
        return $model->newQuery()->with(['createdBy', 'updatedBy']);;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('repairservicessubpage-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->processing(true)
            ->serverSide(true)
            ->orderBy(5, 'desc')
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
            Column::make('page_category')->title('Category'),
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
        return 'RepairServicesSubPage_' . date('YmdHis');
    }
}
