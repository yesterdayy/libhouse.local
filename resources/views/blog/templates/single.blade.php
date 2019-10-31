@extends('blog')

@section('content')
    <article class="entry-single entry-{{ get_post_id() }}">
        @if (get_post_thumbnail('post-wide'))
            <div class="full-width-thumbnail">
                <?= get_post_thumbnail('post-wide') ?>
                <div class="entry-single-head-wrap">
                    @if (get_post_cats_count() > 0)
                        <ul class="entry-cats">
                            @while(get_post_cats())
                                <li><a href="{{ get_cat_link() }}">{{ get_cat_title() }}</a></li>
                            @endwhile
                        </ul>
                    @endif

                    <h1 class="entry-title">{{ get_post_title() }}</h1>
                </div>
            </div>
        @else
            <div class="without-image">
                <div class="entry-title-body">
                    @if (get_post_cats_count() > 0)
                        <ul class="entry-cats">
                            @while(get_post_cats())
                                <li><a href="{{ get_cat_link() }}">{{ get_cat_title() }}</a></li>
                            @endwhile
                        </ul>
                    @endif

                    <h1 class="entry-title">{{ get_post_title() }}</h1>
                </div>
            </div>
        @endif
        <div class="entry-body">
            <div class="entry-info">
                <div class="row">
                    <div class="col-6">
                        <div class="entry-author-avatar">
                            <img src="/upload/avatars/no_ava.jpg" />
                        </div>
                        <div class="entry-author-name">
                            автор
                            <span>{{ get_post_author() }}</span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="entry-post-date">
                            опубликовано
                            <span>{{ get_post_locale_date('F d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="entry-content">
                {!! get_post_content() !!}
            </div>

            <div class="entry-footer">
                <div class="row entry-footer-info">
                    <div class="col-6">
                        <div class="entry-tag-label">Теги</div>
                        @if (get_post_tags_count() > 0)
                        <ul class="entry-tags">
                            @while(get_post_tags())
                                <li><a href="{{ get_tag_link() }}">{{ get_tag_title() }}</a></li>
                            @endwhile
                        </ul>
                        @endif
                    </div>


                    <div class="col-6 text-right">
                        <a href="{!! get_post_attach_link() !!}" class="btn btn-lg" download>{!! get_post_attach_type() !!} Скачать</a>
                    </div>
                </div>

                <div class="entry-footer-delimiter"></div>

                <div class="row entry-social">
                    <div class="col-md-6">
                        <ul class="entry-social-share">
                            <li data-social="vk"><a href="https://vk.com/share.php?url={{ get_post_link() }}" target="_blank"><i class="icon icon-vk"></i></a></li>
                            <li data-social="ok"><a href="https://connect.ok.ru/offer?url={{ get_post_link() }}" target="_blank"><i class="icon icon-odnoklassniki"></i></a></li>
                            <li data-social="facebook"><a href="https://www.facebook.com/sharer.php?u={{ get_post_link() }}" target="_blank"><i class="icon icon-facebook"></i></a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 entry-likes text-right">
                        <i class="icon icon-like"></i> <span>{{ get_post_meta('likes', 0) }}</span>
                    </div>
                </div>

            </div>
        </div>
    </article>

    [related-posts id="{{ get_post_id() }}"]

    [comments id="{{ get_post_id() }}" type="post"]
@endsection
