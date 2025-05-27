<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WATI-Style WhatsApp Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-light p-4">
    <form action="{{ url('whatsapTemplate/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container bg-white p-4 rounded shadow">
            <div>
                <a href="{{ url('whatsapTemplate') }}" class="btn btn-primary">Back</a>
                
            </div>
            <br>
            <h4>WhatsApp Template</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Template Name</label>
                        <input type="text" class="form-control" name="template_name" placeholder="Enter template name"
                        value="{{ $template->template_name }}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" disabled>
                            <option value="">Select Category</option>
                            <option value="marketing" {{ $template->category == 'marketing' ? 'selected':'' }}>Marketing</option>
                            <option value="authenticaton" {{ $template->category == 'authenticaton' ? 'selected':'' }}>Authenticaton</option>
                            <option value="utility" {{ $template->category == 'utility' ? 'selected':'' }}>Utility</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Language</label>
                        <select class="form-select" name="language" disabled>
                            <option value="1" {{ $template->language == 1 ? 'selected':'' }}>English</option>
                            <option value="2" {{ $template->language == 2 ? 'selected':'' }}>Urdu</option>
                            <option value="3" {{ $template->language == 3 ? 'selected':'' }}>Arabic</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">BroadCast Title(optional)</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="none"
                            {{ $template->broadcast_type == 'none' ? 'checked':'' }}disabled>
                            <label class="form-check-label">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="text"
                            {{ $template->broadcast_type == 'text' ? 'checked':'' }} disabled>
                            <label class="form-check-label">Text</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="image"
                            {{ $template->broadcast_type == 'image' ? 'checked':'' }} disabled>
                            <label class="form-check-label">Image</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="video" 
                            {{ $template->broadcast_type == 'video' ? 'checked':'' }} disabled>
                            <label class="form-check-label">Video</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="document"
                            {{ $template->broadcast_type == 'document' ? 'checked':'' }} disabled>
                            <label class="form-check-label">Document</label>
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="headerText" class="mb-3   {{ $template->broadcast_type == 'text' ? '':'hidden' }}">
                        <label class="form-label"> Text</label>
                        <input type="text" class="form-control" name="broadcast_description" placeholder="Enter header text"
                        value="{{ $template->broadcast_description }}" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="headerMedia" class="mb-3 {{ $template->broadcast_type == 'text' || $template->broadcast_type == 'none' ? 'hidden':'' }}">
                        <label class="form-label">Upload Media</label>
                        <input type="file" class="form-control" name="broadcast_media" accept="image/*,video/*,application/pdf" disabled>
                    </div>
                    @if (!empty($template->broadcast_media))
                        <a href="{{ asset('BroadcastMedia/'.$template->broadcast_media) }}">{{ $template->broadcast_media }}</a>
                    @endif
                </div>
                <div class="col-md-12">
                    <div id="headerMediaUrl" class="mb-3 {{ $template->broadcast_type == 'text' || $template->broadcast_type == 'none' ? 'hidden':'' }}">
                        <input type="text" class="form-control" name="broadcast_media_url" accept="image/*,video/*,application/pdf"
                        value="{{ $template->broadcast_media_url }}" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Body Text</label>
                        <textarea class="form-control" rows="4" name="body_text"
                            placeholder="Use {{1}}, {{2}} for dynamic values" disabled>{{ $template->body_text }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Footer (optional)</label>
                        <input type="text" class="form-control" placeholder="Footer text" name="footer_text" value="{{ $template->footer_text }}" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Button</label>
                        <select id="ctaType" class="form-select" name="template_button" disabled>
                            <option value="0" {{ $template_button = 0 ? 'selected' : '' }}>None</option>
                            <option value="1" {{ $template_button = 1 ? 'selected' : '' }}>Call to Action Type</option>
                            <option value="2" {{ $template_button = 2 ? 'selected' : '' }}>Quick Reply</option>
                        </select>
                    </div>
                    <div id="quickRpltText" class="mb-3 @if($template->template_button == 0 || $template->template_button == 1) hidden @endif">
                        <input type="text" class="form-control" placeholder="Button Text" name="quick_reply_text" disabled>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-4 @if($template->template_button == 0 || $template->template_button == 2) hidden @endif cta">
                            <div class="mb-3" >
                                <select id="callToAction" class="form-select" name="cta_type" disabled>
                                    <option value="">Select Type</option>
                                    <option value="0" {{ $cta_type = 0 ? 'selected' : '' }}>Call Phone</option>
                                    <option value="1" {{ $cta_type = 1 ? 'selected' : '' }}>Visit Website</option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-4 @if($template->template_button == 0 || $template->template_button == 2 || $template->cta_type == 1) hidden @endif phone" >
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Button Text" name="phone_number_description"
                                value="{{ $template->phone_number_description }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 @if($template->template_button == 0 || $template->template_button == 2 || $template->cta_type == 1) hidden @endif phone">
                            <div  class="mb-3 ">
                                <input type="tel" class="form-control" placeholder="+92XXXXXXXXX" name="phone_number"
                                value="{{ $template->phone_number }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-7 @if($template->template_button == 0 || $template->template_button == 2 ||  $template->cta_type == 0) hidden @endif website" >
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Website Text" name="website_description"
                                value="{{ $template->website_description }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-4 website @if($template->template_button == 0 || $template->template_button == 2 || $template->cta_type == 0) hidden @endif">
                            <select id="ctaType" class="form-select" name="website_type" disabled>
                                <option value="">Select Type</option>
                                <option value="0" {{ $template->website_type = 0 ? 'selected' : '' }}>Static</option>
                                <option value="1" {{ $template->website_type = 1 ? 'selected' : '' }}>Dynamic</option>
                            </select>
                        </div>
                        <div class="col-md-7 website @if($template->template_button == 0 || $template->template_button == 2 || $template->cta_type == 0) hidden @endif">
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Site Url" name="website_url" disabled 
                                value="{{ $template->website_url }}">
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </form>
    <!-- jQuery Logic -->
    <script>
        $(document).ready(function () {
      $('.header-radio').change(function () {
        var selected = $('input[name="broadcast_type"]:checked').val();

        $('input[name="broadcast_description"]').val('');
        $('input[name="broadcast_media"]').val('');
        $('input[name="broadcast_media_url"]').val('');

        $('#headerText, #headerMedia, #headerMediaUrl').addClass('hidden');

        if (selected === 'text') {
          $('#headerText').removeClass('hidden');
        } else if (selected === 'image' || selected === 'video' || selected === 'document') {
          $('#headerMedia, #headerMediaUrl').removeClass('hidden');
        }
      });

      $('#ctaType').change(function () {
        var cta = $(this).val();

        $('#quickRpltText').addClass('hidden');
        $('.cta,.phone,.website').addClass('hidden');

        $('input[name="website_description"]').val('');
        $('select[name="website_type"]').val('');
        $('input[name="website_url"]').val('');
        $('input[name="quick_reply_text"]').val('');
        $('input[name="phone_number_description"]').val('');
        $('input[name="phone_number"]').val('');
        $('select[name="cta_type"]').val('');

        if (cta == 1) {

          $('.cta').removeClass('hidden');
          $('#quickRpltText').addClass('hidden');

        } else if (cta == 2) {

          $('#quickRpltText').removeClass('hidden');
          $('.cta,.phone,.website').addClass('hidden');

        }
      });
      $('#callToAction').change(function(){

        var cta = $(this).val();
        $('#ctaPhone, #ctaUrl').addClass('hidden');
        $('.phone,.website').addClass('hidden');

        $('input[name="website_description"]').val('');
        $('select[name="website_type"]').val('');
        $('input[name="website_url"]').val('');
        $('input[name="phone_number_description"]').val('');
        $('input[name="phone_number"]').val('');

        if (cta == 0) {

          $('.phone').removeClass('hidden');
          $('.website').addClass('hidden');

        } else if (cta == 1) {

          $('.website').removeClass('hidden');
          $('.phone').addClass('hidden');

        }
      })
    });
    </script>
</body>

</html>
