import imageIcon from '@ckeditor/ckeditor5-core/theme/icons/image.svg';

import ButtonView from '@ckeditor/ckeditor5-ui/src/button/buttonview';

import Plugin from '@ckeditor/ckeditor5-core/src/plugin';


class BookingCoreUploader extends Plugin {
    init() {
        const editor = this.editor;

        editor.ui.componentFactory.add( 'bookingCoreUplader', locale => {
            const view = new ButtonView( locale );

            view.set( {
                label: 'Insert image',
                icon: imageIcon,
                tooltip: true
            } );

            // Callback executed once the image is clicked.
            view.on( 'execute', () => {

                uploaderModal.show({
                    multiple:true,
                    file_type:'image',
                    onSelect:function (files) {

                        if(typeof files !='undefined' && files.length)
                        {

                            const docFrag = writer.createDocumentFragment();

                            for(var i = 0 ; i < files.length; i++){
                                ids.push(files[i].id);

                                const imageElement = writer.createElement( 'image', {
                                    src: files[i].thumb_size
                                } );

                                writer.append( imageElement, docFrag );

                            }

                            editor.model.insertContent( docFrag, editor.model.document.selection );
                        }

                    },
                });


            } );

            return view;
        } );
    }
}

export default BookingCoreUploader