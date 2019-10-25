@extends('layouts.app')
@section('content')
    <style>
        .table-filter{
            display: block;
            width:100%;
            padding:15px;
        }
    </style>
    <div class="container">
        <div class="row"><br><br><br><br>
            <div class="col-md-12">
                <div class="table-filter">
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control filter-name" id="staticEmail2" placeholder="search here">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="date" class="form-control filter-date" id="inputPassword2" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <select class="form-control filter-group" id="exampleFormControlSelect1">
                                <option value="null">Choose one</option>
                                <option value="all">All Groups</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->type }}">
                                    @if($group->type == 'upload')
                                        Content Upload
                                    @elseif($group->type == 'curation')
                                        Content Curation
                                    @elseif($group->type == 'rss-automation')
                                        RSS Automation
                                    @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-dark" style="background: #9d9d9d;color:#fff;">
                    <tr>
                        <th scope="col">Group Name</th>
                        <th scope="col">Group Type</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Post Text</th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody class="ajax-content">
                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->groupInfo->name }}</th>
                            <td>
                                @if($post->groupInfo->type == 'upload')
                                    <span>Content Upload</span>
                                @elseif($post->groupInfo->type == 'curation')
                                    <span>Content Curation</span>
                                @elseif($post->groupInfo->type == 'rss-automation')
                                    <span>RSS Automation</span>
                                @endif
                            </td>
                            <td>
                                <div class="account-info" style="position: relative;">
                                    <img src="{{ $post->accountInfo->avatar }}" alt="{{ $post->accountInfo->name }}" style="width: 48px;height: 48px;border-radius: 50%;" class="img-responsive">
                                    <span style="position: absolute;top: -10px;left: 35%;background: #398ee6;padding: 5px;border-radius: 50%;height: 30px;width: 30px; display: flex;justify-content: center;align-items: center;color: #fff;    border: 2px solid #fff;">
                                        @if($post->accountInfo->type == 'facebook')
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        @elseif($post->accountInfo->type == 'linkedin')
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        @elseif($post->accountInfo->type == 'google')
                                            <i class="fa fa-google" aria-hidden="true"></i>
                                        @elseif($post->accountInfo->type == 'twitter')
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        @elseif($post->accountInfo->type == 'instagram')
                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td>{{ $post->post_text }}</td>
                            <td> {{ Carbon\Carbon::parse($post->updated_at)->format('j M, Y h:i a') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="width: 100%;display: block;text-align: center;">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $('.filter-group').change(function () {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('search-type') }}",
                    data : {type:value},
                    type: "get",
                    success : function(response){
                        $('.ajax-content').html(response);
                    },

                });
//                console.log($(this).val());
            });
        });
    </script>
@endsection