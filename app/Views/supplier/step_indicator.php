<div class="px-5 py-3 mb-sm-5 mb-5 ">
    <div class="position-relative m-4">
        <div class="progress" style="height: 3px;">
            <div class="progress-bar bg-secondary" id="progressBar" role="progressbar" style="width: <?= $step == 1 ? '0%' : ($step == 2 ? '25%' : ($step == 3 ? '50%' : ($step == 4 ? '75%' : '100%'))) ?>;" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <button type="button" class="step-indicator position-absolute top-0 translate-middle btn btn-sm border-0 rounded-pill <?= $step >= 1 ? 'text-white tr-bg-primary' : 'btn-light' ?>" style="width: 2.5rem; height:2.5rem; left:0%;">
            1
        </button>
        <button type="button" class="step-indicator position-absolute top-0 translate-middle btn btn-sm border-0 rounded-pill  <?= $step >= 2 ? 'text-white tr-bg-primary' : 'btn-light' ?>" style="width: 2.5rem; height:2.5rem; left:25%;">
            2
        </button>
        <button type="button" class="step-indicator position-absolute top-0 translate-middle btn btn-sm border-0 rounded-pill  <?= $step >= 3 ? 'text-white tr-bg-primary' : 'btn-light' ?>" style="width: 2.5rem; height:2.5rem; left:50%;">
            3
        </button>
        <button type="button" class="step-indicator position-absolute top-0 translate-middle btn btn-sm border-0 rounded-pill  <?= $step >= 4 ? 'text-white tr-bg-primary' : 'btn-light' ?>" style="width: 2.5rem; height:2.5rem; left:75%;">
            4
        </button>
        <button type="button" class="step-indicator position-absolute top-0 translate-middle btn btn-sm border-0 rounded-pill  <?= $step >= 5 ? 'text-white tr-bg-primary' : 'btn-light' ?>" style="width: 2.5rem; height:2.5rem; left:100%;">
            5
        </button>
    </div>
</div>