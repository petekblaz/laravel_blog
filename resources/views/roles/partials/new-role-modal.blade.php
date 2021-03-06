{{-- Delete modal - with form, where user can select where articles from deleted role are to be moved --}}
<div class="modal create-modal">
	<div class="modal-background animated fadeIn"></div>
	<div class="modal-content animated fadeInDownBig">
		
		<form action="{{ route('roles.store') }}" method="POST">
			{{ csrf_field() }}
			<h1 class="title is-5">Creating new role</h1>
			<label for="new-user-role">Role Name</label>
			<input class="input" type="text" name="name" required="required" minlength="2" maxlength="15" placeholder="role name here">
			<button class="button is-info is-pulled-right" type="submit">Add role</button>
			<button type="button" class="button is-pulled-right close-modal">Cancel</button>
		</form>
	<button class="modal-close is-large"></button>
	</div>
</div> {{-- end of modal --}}