<div>
    top
    <flux:button variant="danger">button</flux:button>
    <flux:heading>User profile</flux:heading>
    <flux:subheading>This information will be displayed publicly.</flux:subheading>
    <flux:modal.trigger name="edit-profile">
        <flux:button>Edit profile</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update profile</flux:heading>
                <flux:subheading>Make changes to your personal details.</flux:subheading>
            </div>

            <flux:input label="Name" placeholder="Your name" />

            <flux:input label="Date of birth" type="date" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
