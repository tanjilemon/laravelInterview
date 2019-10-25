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