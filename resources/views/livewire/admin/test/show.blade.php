<div>
    <x-admin.layouts.breadcrumb pre='Admin/Test'
        now='Show' />

    <div class="card mb-4">
        <h5 class="card-header">Test Form</h5>
        <form wire:submit='save'
            class="card-body"
            novalidate>
            <h6>Fill the details Details</h6>
            <div class="row g-3">
                <label class="col-md-6">
                    <h3 class="form-label">Title</h3>
                    <input wire:model='form.title'
                        type="text"
                        name="title"
                        placeholder="title"
                        aria-describedby="form title"
                        @class([
                            'form-control',
                            'border-danger border-2' => $errors->has('form.title'),
                        ])
                        @error('form.title')
                    aria-invalid="true"
                    aria-description="{{ $message }}"
                    @enderror>
                    @error('form.title')
                        <h6 class="text-danger fst-italic"
                            aria-live="assertive">{{ $message }}</h6>
                    @enderror
                </label>
                <div class="col-md-6">
                    <label class="form-label"
                        for="phone">phone</label>
                    <input wire:model='form.phone'
                        type="text"
                        id="phone"
                        name="phone"
                        class="form-control"
                        placeholder="john.doe"
                        aria-label="phone"
                        aria-describedby="form phone">
                </div>

                <div>
                    <label class="form-label"
                        for="description">description</label>
                    <textarea wire:model='form.description'
                        type="text"
                        id="description"
                        name="description"
                        class="form-control"
                        placeholder="john.doe"
                        aria-label="description"
                        aria-describedby="form description"></textarea>
                </div>

                <div class="form-check mt-3">
                    <input name="default-radio-1"
                        class="form-check-input"
                        type="radio"
                        value="bb"
                        id="defaultRadio1">
                    <label class="form-check-label"
                        for="defaultRadio1"> Unchecked </label>
                </div>
                <div class="form-check mt-3">
                    <input name="default-radio-1"
                        class="form-check-input"
                        type="radio"
                        value="aa"
                        id="abs">
                    <label class="form-check-label"
                        for="abs"> Unchecked </label>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-primary loading me-sm-3 me-1 waves-effect waves-light">
                        <span wire:loading
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"></span>Submit</button>
                    <button type="reset"
                        class="btn btn-label-secondary waves-effect">Cancel</button>
                </div>
        </form>
        <div x-show="$wire.form.showSuccessIndicator"
            x-transition:opacity.duration.2000ms
            x-effect="if($wire.form.showSuccessIndicator) setTimeout(()=> $wire.form.showSuccessIndicator = false ,3000)">
            <div class="alert alert-success d-flex align-items-center"
                role="alert">
                <span class="alert-icon text-success me-2">
                    <i class="ti ti-check ti-xs"></i>
                </span>
                This is a success solid alert — check it out!
            </div>
        </div>

    </div>
</div>
