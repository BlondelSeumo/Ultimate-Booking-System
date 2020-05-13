@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Reviews")}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{url('admin/module/review/bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="approved">{{__(" Approved ")}}</option>
                            <option value="pending">{{__(" Pending ")}}</option>
                            <option value="spam">{{__(" Spam ")}}</option>
                            <option value="trash">{{__(" Move to Trash ")}}</option>
                            <option value="delete">{{__(" Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="post" action="{{url('/admin/module/review/')}} " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    @csrf
                    @if(!empty($rows))
                        <?php
                        $user = !empty(Request()->vendor_id) ? App\User::find(Request()->vendor_id) : false;
                        \App\Helpers\AdminForm::select2('vendor_id', [
                            'configs' => [
                                'ajax'        => [
                                    'url' => url('/admin/module/user/getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'allowClear'  => true,
                                'placeholder' => __('-- Vendor --')
                            ]
                        ], !empty($user->id) ? [
                            $user->id,
                            $user->name_or_email . ' (#' . $user->id . ')'
                        ] : false)
                        ?>
                    @endif
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by title')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <div class="header-status-control">
                <a href="{{ url("/admin/module/review") }}">{{__("All Reviews")}}
                    <span>({{ \Modules\Review\Models\Review::countReviewByStatus() }})</span> </a> -
                <a href="{{ url("/admin/module/review?status=approved") }}">{{__("Approved")}}
                    <span>({{ \Modules\Review\Models\Review::countReviewByStatus("approved") }})</span></a> -
                <a href="{{ url("/admin/module/review?status=pending") }}">{{__("Pending")}}
                    <span>({{ \Modules\Review\Models\Review::countReviewByStatus("pending") }})</span></a> -
                <a href="{{ url("/admin/module/review?status=spam") }}">{{__("Spam")}}
                    <span>({{ \Modules\Review\Models\Review::countReviewByStatus("spam") }})</span></a> -
                <a href="{{ url("/admin/module/review?status=spam") }}">{{__("Trash")}}
                    <span>({{ \Modules\Review\Models\Review::countReviewByStatus("trash") }})</span></a>
            </div>
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th width="150px"> {{ __('Author')}}</th>
                            <th> {{ __('Review Content')}}</th>
                            <th width="250px"> {{ __('In Response To')}}</th>
                            <th width="80px"> {{ __('Service')}}</th>
                            <th width="100px"> {{ __('Status')}}</th>
                            <th width="140px"> {{ __('Submitted On')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($rows->total() > 0)
                            @foreach($rows as $row)
                                @php $service = $row->getService @endphp
                                <tr class="{{$row->status}}">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                    </td>
                                    <td>
                                        {{ $row->getAuthor->name ?? 'Author' }}
                                        <a href="{{ url("/admin/module/review?customer_id=".$row->getAuthor->id) }}">{{ $row->getAuthor->email ?? 'Email' }}</a>
                                        <p>
                                            <a href="{{ url("/admin/module/review?s=".$row->author_ip) }}">{{$row->author_ip}}</a>
                                        </p>
                                    </td>
                                    <td>
                                        <strong>{{$row->title}}</strong>
                                        <p>{{$row->content}}</p>
                                        @if($row->rate_number)
                                            <ul class="review-star left">
                                                @for( $i = 0 ; $i < 5 ; $i++ )
                                                    @if($i < $row->rate_number)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @else
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                        @endif
                                        @if(!empty($service) and !empty($allReviewStats = $service->getReviewStats()))
                                            @if(!empty($metaReviews = $row->getReviewMeta()))
                                                <a class="btn-show-info-review right" data-toggle="collapse" href="#review-{{$row->id}}">
                                                    {{__("More info")}}
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </a>
                                                <div class="collapse" id="review-{{$row->id}}">
                                                    <div class="review-items">
                                                        <div class="row">
                                                            @foreach($metaReviews as $metaReview)
                                                                @if( in_array($metaReview->name , $allReviewStats))
                                                                    <div class="item col-md-12 d-flex">
                                                                        <label style="margin-right: 15px;">{{$metaReview->name}}</label>
                                                                        <ul class="review-star">
                                                                            @for( $i = 0 ; $i < 5 ; $i++ )
                                                                                @if($i < $metaReview->val)
                                                                                    <li><i class="fa fa-star"></i></li>
                                                                                @else
                                                                                    <li><i class="fa fa-star-o"></i>
                                                                                    </li>
                                                                                @endif
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($service))
                                            <a href="{{ url("/admin/module/review?service_id=".$service->id) }}">
                                                {{ $service->title }}
                                            </a>
                                            <p>
                                                <a target="_blank" href="{{$service->getDetailUrl()}}">
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{ __("View :name",["name"=>$service->getModelName() ])}}
                                                </a>
                                            </p>
                                        @else
                                            {{__("[Deleted]")}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($service))
                                            <a href="{{ url("/admin/module/review?service=".$service->getModelName()) }}" class="badge badge-dark">{{  $service->getModelName() }}</a>
                                        @else
                                            {{__("[Deleted]")}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url("/admin/module/review?status=".$row->status) }}" class="badge badge-{{ $row->status }}">{{ $row->status }}</a>
                                    </td>
                                    <td>{{ display_datetime($row->updated_at)}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">{{__("No data")}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
