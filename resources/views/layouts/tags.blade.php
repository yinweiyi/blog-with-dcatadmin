<div class="panel panel-default">
    <div class="panel-heading"> 随机标签云</div>
    <div class="panel-body tagcloud">

        @foreach($tags as $tag)
            <a href="#" class="tag-cloud-link tag-link-13 tag-link-position-1"
               style="color:#677d47;font-size: {{ mt_rand(8,14) }}pt;"
               aria-label="{{ $tag }} (2个项目);">
                {{ $tag }}
            </a>
        @endforeach
    </div>
</div>
