(function () {
    'use strict'

    /* dropzone */
    let myDropzone = new Dropzone(".dropzone");
        myDropzone.on("addedfile", file => {
    });
    
    /* filepond */
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileEncode,
        FilePondPluginImageEdit,
        FilePondPluginFileValidateType,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform
    );

    /* multiple upload */
    const MultipleElement = document.querySelector('.multiple-filepond');
    FilePond.create(MultipleElement,);

    /* multiple upload */
    const MultipleElementt = document.querySelector('.multiple-filepond-1');
    FilePond.create(MultipleElementt,);

    /* multiple upload */
    const MultipleElementtt = document.querySelector('.multiple-filepond-2');
    FilePond.create(MultipleElementtt,);
    
    /* single upload */
    FilePond.create(
        document.querySelector('.single-fileupload'),
        {
            labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleButtonRemoveItemPosition: 'center bottom'
        }
    );

})();