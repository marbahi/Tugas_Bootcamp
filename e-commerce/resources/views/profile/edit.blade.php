<x-app-layout headerTitle="Profile">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="panel-card p-4 p-sm-5 mb-4">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="panel-card p-4 p-sm-5 mb-4">
                @include('profile.partials.update-password-form')
            </div>

            <div class="panel-card p-4 p-sm-5">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>