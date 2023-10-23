<!-- MODAL ADD SEMESTER -->
<div class="modal fade" id="addSemesterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Semester form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <form action="add_semester.php" method="POST" class="needs-validation" novalidate>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                        <label for="name">Semester</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter semester.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="start_year" id="start_year" placeholder="start_year" class="form-control bg-body-tertiary" maxlength="4" required />
                        <label for="start_year">Beginning year of the semester</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a year.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="end_year" id="end_year" placeholder="end_year" class="form-control bg-body-tertiary" maxlength="4" required />
                        <label for="end_year">End year of the semester</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a year.</div>
                    </div>
                    <div class="mt-4 me-auto">
                        <input type="submit" value="Add" class="btn btn-primary" name="submit">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>