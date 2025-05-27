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
            <h4>WhatsApp Template Creation</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Template Name</label>
                        <input type="text" class="form-control" name="template_name" placeholder="Enter template name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category">
                            <option value="">Select Category</option>
                            <option value="marketing">Marketing</option>
                            <option value="transactional">Transactional</option>
                            <option value="otp">One-Time Password (OTP)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Language</label>
                        <select class="form-select" name="language">
                            <option value="en">English</option>
                            <option value="ur">Urdu</option>
                            <option value="ar">Arabic</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">BroadCast Title(optional)</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="none" checked>
                            <label class="form-check-label">None</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="text">
                            <label class="form-check-label">Text</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="image">
                            <label class="form-check-label">Image</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="video">
                            <label class="form-check-label">Video</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input header-radio" type="radio" name="broadcast_type" value="document">
                            <label class="form-check-label">Document</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="headerText" class="mb-3 hidden">
                        <label class="form-label"> Text</label>
                        <input type="text" class="form-control" name="broadcast_description" placeholder="Enter header text">
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="headerMedia" class="mb-3 hidden">
                        <label class="form-label">Upload Media</label>
                        <input type="file" class="form-control" name="broadcast_media" accept="image/*,video/*,application/pdf">
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="headerMediaUrl" class="mb-3 hidden">
                        <input type="text" class="form-control" name="broadcast_media_url" accept="image/*,video/*,application/pdf">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Body Text</label>
                        <textarea class="form-control" rows="4" name="body_text"
                            placeholder="Use {{1}}, {{2}} for dynamic values"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Footer (optional)</label>
                        <input type="text" class="form-control" placeholder="Footer text" name="footer_text">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Button</label>
                        <select id="ctaType" class="form-select" name="template_button">
                            <option value="0">None</option>
                            <option value="1">Call to Action Type</option>
                            <option value="2">Quick Reply</option>
                        </select>
                    </div>
                    <div id="quickRpltText" class="mb-3 hidden">
                        <input type="text" class="form-control" placeholder="Button Text" name="quick_reply_text">
                    </div>
                    <div class="row">
                        <div class="col-md-4 hidden cta">
                            <div class="mb-3" >
                                <select id="callToAction" class="form-select" name="cta_type">
                                    <option value="">Select Type</option>
                                    <option value="0">Call Phone</option>
                                    <option value="1">Visit Website</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 hidden phone" >
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Button Text" name="phone_number_description">
                            </div>
                        </div>
                        <div class="col-md-4 hidden phone">
                            <div  class="mb-3 ">
                                <input type="tel" class="form-control" placeholder="+92XXXXXXXXX" name="phone_number">
                            </div>
                        </div>
                        <div class="col-md-7 hidden website" >
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Website Text" name="website_description">
                            </div>
                        </div>
                        <div class="col-md-4 website hidden">
                            <select id="ctaType" class="form-select" name="website_type">
                                <option value="">Select Type</option>
                                <option value="0">Static</option>
                                <option value="1">Dynamic</option>
                            </select>
                        </div>
                        <div class="col-md-7 website hidden">
                            <div  class="mb-3 ">
                                <input type="text" class="form-control" placeholder="Site Url" name="website_url">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary mt-3">Create Template</button>
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
