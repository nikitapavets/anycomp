import Elements from '../../base/Elements';
import Api from '../Api';

export default class RepairPage extends Elements {
  constructor(id) {
    super();

    this.repair = {id};
    this.addEventListeners();
  }

  addEventListeners() {
    this.onChangeWorkerHandle();
    this.onChangeLocationHandle();
  }

  onChangeWorkerHandle() {
    const select = document.querySelector('#editWorkerHandle select');
    select.addEventListener('change', _ => {
      Api.post(`/api/repairs/${this.repair.id}/set-worker`, {
        worker_id: select.value,
      });
    }, false);
  }

  onChangeLocationHandle() {
    const select = document.querySelector('#editLocationHandle select');
    select.addEventListener('change', _ => {
      Api.post(`/api/repairs/${this.repair.id}/set-location`, {
        location_id: select.value,
      });
    }, false);
  }
}