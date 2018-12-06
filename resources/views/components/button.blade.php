@if (empty($value))

  @php
    $value= 'Enregistrer';
  @endphp

@endif

@if (empty($submit))

  @php
    $submit = 'submit';
  @endphp

@endif

                <input type="cancel" class="btn btn-warning" value="Cancel" />
                <input type="reset" class="btn btn-danger" value="Reset" />
                <input type="submit" id="{{ $submit }}" class="btn btn-primary pull-right" value="{{ $value }}" />