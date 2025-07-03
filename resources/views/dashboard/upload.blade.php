<h2>Upload Product</h2>

<form action="/dashboard/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Product Image:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Upload</button>
</form>
