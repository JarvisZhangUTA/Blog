<template>
    <script id="container" name="body" type="text/plain">
    </script>
</template>

<script>
    export default {
        props: [
            'content'
        ],
        mounted() {
            const ele = document.getElementById('container');
            const content = this.content;
            if(ele){
                ele.style.height='70%';
                ele.style.width='100%';

                let ue = UE.getEditor('container', {
                    toolbars: [
                        ['bold', 'italic', 'underline', 'strikethrough', 'blockquote',
                            'insertunorderedlist', 'insertorderedlist', 'justifyleft',
                            'justifycenter', 'justifyright',  'link', 'insertimage']
                    ],
                    elementPathEnabled: false,
                    enableContextMenu: false,
                    autoClearEmptyNode:true,
                    wordCount:false,
                    imagePopup:false,
                    autotypeset:{ indent: true,imageBlockLine: 'center' }
                });
                ue.ready(function() {
                    ue.setContent(content);
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            }
        }
    }
</script>
