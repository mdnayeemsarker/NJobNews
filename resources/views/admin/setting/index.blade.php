@extends('admin.layouts.app')
@php
    $selector = true;
@endphp
@section('title', 'Setting')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Setting'])
@endsection
@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Setting',
        'pTitle' => 'Setting',
    ])
@endsection
@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('General Setting') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="general-ajax-form">
                @csrf
                <input type="hidden" name="part" value="general">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Favicon</label>
                        <div class="file-selector-container text-center p-2 border rounded">
                            <div class="file-selector-item single-selector" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single" data-input-name="favicon"
                                data-title="Select Favicon">
                                <i class="fa fa-file fa-2x"></i>
                                <span class="d-block mt-2">Select Favicon</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                            @if (!empty(get_setting('favicon')))
                                <div class="text-center">
                                    <img src="{{ get_file_url(get_setting('favicon')) }}" alt="favicon"
                                        class="img-fluid rounded shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Logo</label>
                        <div class="file-selector-container text-center p-2 border rounded">
                            <div class="file-selector-item single-selector" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single" data-input-name="logo"
                                data-title="Select Logo">
                                <i class="fa fa-file fa-2x"></i>
                                <span class="d-block mt-2">Select Logo</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                            @if (!empty(get_setting('logo')))
                                <div class="text-center">
                                    <img src="{{ get_file_url(get_setting('logo')) }}" alt="logo"
                                        class="img-fluid rounded shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Company Information') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="company-ajax-form">
                @csrf
                <input type="hidden" name="part" value="company">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="site_title">Title</label>
                        <input type="text" id="site_title" name="site_title" class="form-control"
                            value="{{ get_setting('site_title', '') }}" placeholder="Enter Title" />
                    </div>
                    <div class="col-md-6">
                        <label for="author">Author</label>
                        <input type="text" id="author" name="author" class="form-control"
                            value="{{ get_setting('author', '') }}" placeholder="Enter Author" />
                    </div>
                    <div class="col-md-6">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control"
                            value="{{ get_setting('address', '') }}" placeholder="Enter Address" />
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control"
                            value="{{ get_setting('email', '') }}" placeholder="Enter Email" />
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                            value="{{ get_setting('phone', '') }}" placeholder="Enter Phone" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Color Setting') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="color-ajax-form">
                @csrf
                <input type="hidden" name="part" value="color">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="sub_title_one">Sub Title One Color</label>
                        <input type="color" id="sub_title_one" name="sub_title_one" class="form-control"
                            value="{{ get_setting('sub_title_one', '') }}" placeholder="Enter Title" />
                    </div>
                    <div class="col-md-4">
                        <label for="sub_title_two">Sub Title Two Color</label>
                        <input type="color" id="sub_title_two" name="sub_title_two" class="form-control"
                            value="{{ get_setting('sub_title_two', '') }}" placeholder="Enter Title" />
                    </div>
                    <div class="col-md-4">
                        <label for="special_section_bg">Special Section Background Color</label>
                        <input type="color" id="special_section_bg" name="special_section_bg" class="form-control"
                            value="{{ get_setting('special_section_bg', '') }}" placeholder="Enter Title" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Social Links') }}</h5>
            </h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="social-link-ajax-form">
                @csrf
                <input type="hidden" name="part" value="social_links">

                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" name="facebook" class="form-control"
                            value="{{ get_setting('facebook', '') }}" placeholder="Enter Facebook URL" />
                    </div>

                    <div class="col-md-6">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" name="twitter" class="form-control"
                            value="{{ get_setting('twitter', '') }}" placeholder="Enter Twitter URL" />
                    </div>

                    <div class="col-md-6">
                        <label for="youtube">YouTube</label>
                        <input type="text" id="youtube" name="youtube" class="form-control"
                            value="{{ get_setting('youtube', '') }}" placeholder="Enter YouTube URL" />
                    </div>

                    <div class="col-md-6">
                        <label for="instagram">Instagram</label>
                        <input type="text" id="instagram" name="instagram" class="form-control"
                            value="{{ get_setting('instagram', '') }}" placeholder="Enter Instagram URL" />
                    </div>

                    <div class="col-md-6">
                        <label for="linkedin">LinkedIn</label>
                        <input type="text" id="linkedin" name="linkedin" class="form-control"
                            value="{{ get_setting('linkedin', '') }}" placeholder="Enter LinkedIn URL" />
                    </div>

                    <div class="col-md-6">
                        <label for="pinterest">Pinterest</label>
                        <input type="text" id="pinterest" name="pinterest" class="form-control"
                            value="{{ get_setting('pinterest', '') }}" placeholder="Enter Pinterest URL" />
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('SEO Setting') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="seo-ajax-form">
                @csrf
                <input type="hidden" name="part" value="seo">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="title_seo">SEO Title</label>
                        <input type="text" id="title_seo" name="seo_title" class="form-control"
                            value="{{ get_setting('seo_title', '') }}" placeholder="Enter SEO Title" />
                    </div>
                    <div class="col-md-6">
                        <label for="keywords_seo">Keywords</label>
                        <input type="text" id="keywords_seo" name="seo_keywords" class="form-control"
                            value="{{ get_setting('seo_keywords', '') }}" placeholder="Enter Keywords" />
                    </div>
                    <div class="col-md-6">
                        <label for="description_seo">Description</label>
                        <input type="text" id="description_seo" name="seo_description" class="form-control"
                            value="{{ get_setting('seo_description', '') }}" placeholder="Enter Description" />
                    </div>
                    <div class="col-md-6">
                        <label for="og_title_seo">OG Title</label>
                        <input type="text" id="og_title_seo" name="seo_og_title" class="form-control"
                            value="{{ get_setting('seo_og_title', '') }}" placeholder="Enter OG Title" />
                    </div>
                    <div class="col-md-6">
                        <label for="og_description_seo">OG Description</label>
                        <input type="text" id="og_description_seo" name="seo_og_description" class="form-control"
                            value="{{ get_setting('seo_og_description', '') }}" placeholder="Enter OG Description" />
                    </div>
                    <div class="col-md-6">
                        <label class="">OG Image</label>
                        <input type="hidden" name="old_og_image" value="{{ get_setting('seo_og_image', '') }}">
                        <div class="file-selector-container text-center p-2 border rounded">
                            <div class="file-selector-item single-selector" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single"
                                data-input-name="seo_og_image" data-title="Select OG Image">
                                <i class="fa fa-file fa-2x"></i>
                                <span class="d-block mt-2">Select OG Image</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                            @if (!empty(get_setting('seo_og_image')))
                                <div class="text-center">
                                    <img src="{{ get_file_url(get_setting('seo_og_image')) }}" alt="og_image"
                                        class="img-fluid rounded shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Ad Setting') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="ads-ajax-form">
                @csrf
                <input type="hidden" name="part" value="ads">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="home_popup_ads">Home Popup Ads</label>
                        <select class="form-control" name="home_popup_ads" id="home_popup_ads">
                            <option value="0" {{ get_setting('home_popup_ads', 0) == 0 ? 'selected' : '' }}>Disable
                            </option>
                            <option value="1" {{ get_setting('home_popup_ads', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="artical_popup_ads">Artical Popup Ads</label>
                        <select class="form-control" name="artical_popup_ads" id="artical_popup_ads">
                            <option value="0" {{ get_setting('artical_popup_ads', 0) == 0 ? 'selected' : '' }}>
                                Disable</option>
                            <option value="1" {{ get_setting('artical_popup_ads', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="artical_right_ads">Artical Right Ads</label>
                        <select class="form-control" name="artical_right_ads" id="artical_right_ads">
                            <option value="0" {{ get_setting('artical_right_ads', 0) == 0 ? 'selected' : '' }}>
                                Disable</option>
                            <option value="1" {{ get_setting('artical_right_ads', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="artical_left_ads">Artical Left Ads</label>
                        <select class="form-control" name="artical_left_ads" id="artical_left_ads">
                            <option value="0" {{ get_setting('artical_left_ads', 0) == 0 ? 'selected' : '' }}>Disable
                            </option>
                            <option value="1" {{ get_setting('artical_left_ads', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Slider & Notice Panel Setting') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="notice-ajax-form">
                @csrf
                <input type="hidden" name="part" value="notice">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="slider_panel">Slider Panel</label>
                        <select class="form-control" name="slider_panel" id="slider_panel">
                            <option value="0" {{ get_setting('slider_panel', 0) == 0 ? 'selected' : '' }}>Disable
                            </option>
                            <option value="1" {{ get_setting('slider_panel', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="slider_panel_title">Slider Panel Title</label>
                        <input type="text" @readonly(get_setting('slider_panel')) id="slider_panel_title" name="slider_panel_title"
                            class="form-control" value="{{ get_setting('slider_panel_title', '') }}"
                            placeholder="Enter Slider Panel Title" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="notice_panel">Notice Panel</label>
                        <select class="form-control" name="notice_panel" id="notice_panel">
                            <option value="0" {{ get_setting('notice_panel', 0) == 0 ? 'selected' : '' }}>Disable
                            </option>
                            <option value="1" {{ get_setting('notice_panel', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="notice_panel_title">Notice Panel Title</label>
                        <input type="text" @readonly(get_setting('notice_panel')) id="notice_panel_title" name="notice_panel_title"
                            class="form-control" value="{{ get_setting('notice_panel_title', '') }}"
                            placeholder="Enter Notice Panel Title" />
                    </div>
                    <div class="col-md-6">
                        <label for="notice_text">OG Description</label>
                        <input type="text" @readonly(get_setting('notice_panel')) id="notice_text" name="notice_text" class="form-control"
                            value="{{ get_setting('notice_text', '') }}" placeholder="Enter OG Description" />
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <h5>{{ __('Special Section') }}</h5>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.setting.update') }}" method="POST" class="special-section-ajax-form">
                @csrf
                <input type="hidden" name="part" value="special">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="special_section">{{ __('Special Section') }}</label>
                        <select name="special_section" id="special_section" class="form-control">
                            <option value="0" {{ get_setting('special_section', 0) == 0 ? 'selected' : '' }}>Disable
                            </option>
                            <option value="1" {{ get_setting('special_section', 0) == 1 ? 'selected' : '' }}>Enable
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('Special Section Image') }}</label>
                        <input type="hidden" name="old_special_section_img"
                            value="{{ get_setting('special_section_img', '') }}">
                        <div class="file-selector-container text-center p-2 border rounded">
                            <div class="file-selector-item single-selector" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single"
                                data-input-name="special_section_img" data-title="Select Special Section Image">
                                <i class="fa fa-file fa-2x"></i>
                                <span class="d-block mt-2">{{ __('Select Special Section Image') }}</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                            @if (!empty(get_setting('special_section_img')))
                                <div class="text-center mt-2">
                                    <img src="{{ get_file_url(get_setting('special_section_img')) }}"
                                        alt="special_section_img" class="img-fluid rounded shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="special_section_link">{{ __('Special Section Link') }}</label>
                        <input type="text" id="special_section_link" name="special_section_link" class="form-control"
                            value="{{ get_setting('special_section_link', '') }}"
                            placeholder="{{ __('Enter Special Section Link') }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.querySelectorAll('form').forEach(form => {
            if (!form.classList.contains('-ajax-form')) {
                if (!form.classList.contains('general-ajax-form') &&
                    !form.classList.contains('company-ajax-form') &&
                    !form.classList.contains('seo-ajax-form') &&
                    !form.classList.contains('special-section-ajax-form') &&
                    !form.classList.contains('notice-ajax-form') &&
                    !form.classList.contains('color-ajax-form') &&
                    !form.classList.contains('social-link-ajax-form') &&
                    !form.classList.contains('ads-ajax-form')) {
                    return;
                }
            }
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let part = formData.get('part'); // general / company / seo
                let title = part.charAt(0).toUpperCase() + part.slice(1); // Capitalize
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function() {
                        notifyToastr('success', 'Setting', `${title} updated successfully!`);
                        if (part != 'company' && part != 'ads' && part != 'color' && part != 'social_links' && part != 'notice') {
                            setTimeout(() => window.location.reload(), 1500);
                        }
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message ||
                            'Something went wrong while updating settings!';
                        notifyToastr('error', 'Setting', msg);
                    }
                });
            });
        });
    </script>
@endsection