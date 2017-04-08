import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_NOTEBOOKS_REQUEST,
    FETCH_NOTEBOOKS_SUCCESS,
    FETCH_NOTEBOOKS_FAILURE
} from '../actions-types/notebooks';

function fetchNotebooksRequest() {
    return {
        type: FETCH_NOTEBOOKS_REQUEST
    }
}

function fetchNotebooksSuccess(payload) {
    return {
        type: FETCH_NOTEBOOKS_SUCCESS,
        payload
    }
}

function fetchNotebooksFailure(payload) {
    return {
        type: FETCH_NOTEBOOKS_FAILURE,
        payload
    }
}

export function handleLoadingNotebooks() {
    return function (dispatch) {
        dispatch(fetchNotebooksRequest());

        return fetch(`${config.server}/api/notebooks`)
            .then(res => res.json())
            .then(json => dispatch(fetchNotebooksSuccess(json)))
            .catch(err => dispatch(fetchNotebooksFailure(err)));
    }
}
