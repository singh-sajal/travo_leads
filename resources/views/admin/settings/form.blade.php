<div class="modal-body">
    <div class="row">
        @if (!empty($setting))
            @if ($setting->key == 'phone')
                <div class="col-12 mb-3">
                    <label for="phone" class="required form-label">Enter Phone Number</label>
                    <input type="text" name="phone" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required
                        maxlength="10" minlength="10" pattern="[0-9]{10}" title="Phone no must be of 10 digits">
                    <span data-error="phone" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'email')
                <div class="col-12 mb-3">
                    <label for="email" class="required form-label">Enter Email Number</label>
                    <input type="text" name="email" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required>
                    <span data-error="email" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'address')
                <div class="col-12 mb-3">
                    <label for="address" class="required form-label">Enter Address</label>
                    <input type="text" name="address" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required>
                    <span data-error="address" class="text-danger mt-2"></span>
                </div>
            @elseif ($type == 'map')
                <div class="col-12 mb-3">
                    <label for="map" class="required form-label">Enter Map iframe</label>
                    <textarea name="map" id="" cols="80" rows="5" required class="form-control">{{ $setting->description ?? '' }}</textarea>
                    <span data-error="map" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'whatsapp')
                <div class="col-12 mb-3">
                    <label for="whatsapp" class="required form-label">Enter Whatsapp</label>
                    <input type="text" name="whatsapp" placeholder="{{ $setting->value ?? '' }}" class="form-control"
                        value="{{ $setting->value ?? '' }}" required>
                    <span data-error="whatsapp" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->common_key == 'social_link')
                <div class="col-12 mb-3">
                    <label for="social_link" class="required form-label">Update Social Link</label>
                    <input type="text" name="social_link" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required>
                    <span data-error="social_link" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->common_key == 'app')
                <div class="col-12 mb-3">
                    <label for="app" class="required form-label">Update App Link</label>
                    <input type="text" name="app" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required>
                    <span data-error="app" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->common_key == 'del_app')
                <div class="col-12 mb-3">
                    <label for="del_app" class="required form-label">Update App Link</label>
                    <input type="text" name="del_app" placeholder="{{ $setting->value ?? '' }}" class="form-control" value="" required>
                    <span data-error="del_app" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'logo')
                <div class="col-12 mb-3">
                    <label for="logo" class="required form-label">Update Logo</label>
                    <input type="file" name="logo" class="form-control" required>
                    <span data-error="logo" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'fevicon')
                <div class="col-12 mb-6">
                    <label for="fevicon" class="required form-label">Update Fevicon Icon</label>
                    <input type="file" name="fevicon" class="form-control" required>
                    <span data-error="fevicon" class="text-danger mt-2"></span>
                </div>
            @elseif ($setting->key == 'video_url')
                <div class="col-12 mb-6">
                    <label for="video_url" class="required form-label">Update Interro Video</label>
                    {{-- <input type="file" name="fevicon" class="form-control" required> --}}
                    <textarea name="video_url" cols="30" rows="5" placeholder="Video URL"
                       class="form-control" required></textarea>
                    <span data-error="video_url" class="text-danger mt-2"></span>
                </div>
            @endif
        @endif
        @if (!empty($request->type))
            @if ($request->type == 'social_link')
                <h4>Add new social link</h4>
                <div class="col-12 mb-6">
                    <label for="icon_code" class="required form-label">Social Link (Rimix icon name)</label>
                    <input type="text" name="icon_code" placeholder="New Social icon name" class="form-control" value="" required>
                    <span><small> e.g. ri-facebook-fill use for facebook. Icon name: facebook</small></span>
                    <span data-error="icon_code" class="text-danger mt-2"></span>
                </div>
                <div class="col-12 mb-3">
                    <label for="social_link" class="required form-label">Social Link URL</label>
                    <input type="text" name="social_link" placeholder="New Social Link" class="form-control" value="" required>
                    <span data-error="social_link" class="text-danger mt-2"></span>
                </div>
            @endif
        @endif


        {{-- <div class="col-12 mb-3">
            <label for="demo_img" class="required form-label">Demo Image</label>
            <input type="file" name="demo_img" class="form-control" value="">
            <span data-error="demo_img" class="text-danger mt-2"></span>
        </div>
        <div class="col-12 mb-3">
            <label for="description">Description</label>
            <div style="height:150px;" id="editor">

            </div>
            <input type="hidden" id="description" name="description" required></input>
            <span data-error="description" class="text-danger mt-2"></span>
        </div> --}}
    </div>

</div>

<div class="modal-footer">
    <div class="row">
        <div class="col mb-3">
            <button class="btn btn-primary" type="submit">Submit</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
