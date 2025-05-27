<div class="card shadow">
    <div class="card-body">
        <h4 class="card-title mb-4">Templates</h4>
        <form>
            <!-- WhatsApp Status -->
            <div class="mb-3">
                <label class="form-label">WhatsApp</label>
                <div>
                    <span class="badge bg-success">Draft</span>
                </div>
            </div>

            <!-- Template Type -->
            <div class="mb-3">
                <label class="form-label">General</label>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="templateType" id="operator" checked>
                                    <label class="form-check-label" for="operator">
                                        Operator
                                    </label>
                                </div>
                                <br>
                                <p>You must register this template with the operator.To broadcast messages,create personalzed custome template
                                    based on registered operator template.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="templateType" id="custom">
                                    <label class="form-check-label" for="custom">
                                        Custom
                                    </label>
                                </div>
                                <br>
                                <p>Setup a custome template based on based on registered operator template.To create a custome template,you must
                                    have atleast one registered operatortemplate.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sender Name -->
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="senderName" class="form-label">Register to this sender name (WhatsApp account)</label>
                        <select class="form-select" id="itemSelect" required>
                            <option value="" disabled selected>-- Select --</option>
                            <option value="alkhidmat_WA">alkhidmat_WA</option>
                            <option value="Banana">Banana</option>
                            <option value="Orange">Orange</option>
                            <option value="Grapes">Grapes</option>
                        </select>
                        <small class="text-muted">
                            Facebook will register this template to your WhatsApp Business Account.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Language -->
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="language" class="form-label">Language</label>
                        <select class="form-select" id="language" required>
                            <option selected>English</option>
                            <option >Urdu</option>
                        </select>
                        <small class="text-muted">
                            Select a language that matches the language of the template text.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Template Name -->
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="templateName" class="form-label">Template name</label>
                        <input type="text" class="form-control is-invalid" id="templateName" name="templateName" placeholder="Enter template name" required>
                        <div class="invalid-feedback">
                            {{--  Only lowercase Latin characters, digits, and the underscore character are allowed. The space character is not allowed.  --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category -->
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="itemSelect" required>
                            <option value="" disabled selected>-- Select --</option>
                            <option value="alkhidmat_WA">Utility</option>
                            <option value="Banana">Marketing</option>
                        </select>
                        <small class="text-muted">
                            You cant change the category of a template after the template is registered.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
