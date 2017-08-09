import {
    SET_BREADCRUMBS
} from '../actions-types/breadcrumbs';

export function setBreadcrumbs(payload) {
    return {
        type: SET_BREADCRUMBS,
        payload
    }
}
