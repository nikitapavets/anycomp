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
  }

  onChangeWorkerHandle() {
    const select = document.querySelector('#editWorkerHandle select');
    select.addEventListener('change', _ => {
      Api.post(`/api/repairs/${this.repair.id}/set-worker`, {
        worker_id: select.value,
      }).then(r => console.log(r.message));
    }, false);
  }
}