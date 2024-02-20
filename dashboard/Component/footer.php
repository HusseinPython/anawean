
    <script src="./layout/js/all.min.js"></script>
    <script src="./layout/js/ckeditor.js"></script>
    <script>
                ClassicEditor
                    .create(document.querySelector('#editor'), {
                        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                    })
                    .then(editor => {
                        window.editor = editor;
                    })
                    .catch(err => {
                        console.error(err.stack);
                    });
    </script>
    <script src="./layout/js/progress.js"></script>
</body>
</html>