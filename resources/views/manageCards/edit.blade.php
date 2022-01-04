@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12 tr-sticky">
        <div class="tr-content theiaStickySidebar">
            <div class="tr-section">
                <div class="tr-post">
                    <div class="section-title title-before">
                    <span class="right"><a href="{{route('manageCards.index')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a></span>
                        <h1><a>Criar nova notícia</a></h1>
                    </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                <div class="tr-details">
                <form action="{{url ("manageCards/$card->id") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @METHOD('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name">Nome *</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$card->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="src_img_onclick">Url Vinculada</label>
                                        <input type="text" class="form-control" id="src_img_onclick" name="src_img_onclick">
                                </div>
                                <div class="col-md-4">
                                    <label for="date">Data Vencimento*</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="active">Situação *</label><br>
                                    <input type="checkbox" name="active" id="active" class="js-switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="">Imagem Principal *</label>
                                    <input type="file" name="files5" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="">Imagem vinculada </label>
                                    <input type="file" name="files6">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <input type="submit" class="btn btn-primary btn-xg btn-block">
                        </div>
                            </div>
                        </div>
                    </form>

                </div><!-- /.tr-details -->
            </div><!-- /.tr-section -->


        </div><!-- row -->
        </div>
      </div><!-- /.row -->
@endsection

@section('script')
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });

    $('#date').val(new Date().toDateInputValue());

    $('.summernote').summernote({
            minHeight: 200,
        });

    $('input[name="files5"]').fileuploader({
        limit: 1,
        files:  [{
            name: '{{$img_name}}', // file name
            size: 902400, // file size in bytes
            type: 'image', // file MIME type
            file: '{{$card->src_img}}', // file path
            local: '{{$card->src_img}}', // file path in listInput (optional)
            data: {
                thumbnail: '{{$card->src_img}}', // item custom thumbnail; if false will disable the thumbnail (optional)
                readerCrossOrigin: 'anonymous', // fix image cross-origin issue (optional)
                readerForce: true, // prevent the browser cache of the image (optional)
                popup: false, // remove the popup for this file (optional)
            }
        }],
        editor: {
            cropper: {
                minWidth: 1300,
                minHeight: 600,
                showGrid: true
            },
            quality: 90
        },
    });

var img_onclick_name = '{{$img_onclick_name}}'

console.log(img_onclick_name)

if(img_onclick_name != ''){
    $('input[name="files6"]').fileuploader({
        limit: 1,
        files:  [{
            name: '{{$img_onclick_name}}', // file name
            size: 902400, // file size in bytes
            type: 'image', // file MIME type
            file: '{{$card->src_img_onclick}}', // file path
            local: '{{$card->src_img_onclick}}', // file path in listInput (optional)
            data: {
                thumbnail: '{{$card->src_img_onclick}}', // item custom thumbnail; if false will disable the thumbnail (optional)
                readerCrossOrigin: 'anonymous', // fix image cross-origin issue (optional)
                readerForce: true, // prevent the browser cache of the image (optional)
                popup: false, // remove the popup for this file (optional)
            }
        }],
        editor: {
            cropper: {
                minWidth: 1300,
                minHeight: 600,
                showGrid: true
            },
            quality: 90
        }
    });
} else {
    $('input[name="files6"]').fileuploader({
        limit: 1,
        editor: {
            cropper: {
                minWidth: 1300,
                minHeight: 600,
                showGrid: true
            },
            quality: 90
        }
    });
}

var elem = document.querySelector('.js-switch');
    var init = new Switchery(elem);

});

</script>

@endsection
