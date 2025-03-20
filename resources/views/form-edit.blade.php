<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Edit User</title>
</head>

<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8">
            <h3 class="text-gray-700 text-3xl font-medium">Edit User Information</h3>
            <div class="mt-6 bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input value="{{ $user->first_name }}" type="text" name="first_name" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input value="{{ $user->last_name }}" type="text" name="last_name" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input value="{{ $user->email }}" type="email" name="email" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input value="{{ $user->phone }}" type="text" name="phone" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input value="{{ $user->address }}" type="text" name="address" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" required class="mt-1 p-2 w-full border rounded-md">
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="mt-1 p-2 w-full border rounded-md">
                            <img src="{{ $user->avatar }}" id="preview"
                                class="max-w-[200px] object-cover rounded my-2 {{ $user->avatar ? '' : 'hidden' }}">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="/" class="bg-gray-500 px-4 py-2 rounded text-white mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-500 px-4 py-2 rounded text-white">Add User</button>
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
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('avatar').addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</html>