<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Markdown Editor</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
</head>

<body>

    <div class="container">
        <h1>Markdown Editor</h1>

        <form id="form">
            <textarea name="text" id="editor">
                </textarea>
        </form>
    </div>

   <!-- Include the required files -->
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<!-- Start simple MDE -->
<script>
    var simplemde = new SimpleMDE({ 
        element: document.getElementById("editor") 
    });
</script>

</body>

</html>
