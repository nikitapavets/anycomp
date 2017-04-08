import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_TVS_REQUEST,
    FETCH_TVS_SUCCESS,
    FETCH_TVS_FAILURE
} from '../actions-types/tvs';

function fetchTvsRequest() {
    return {
        type: FETCH_TVS_REQUEST
    }
}

function fetchTvsSuccess(payload) {
    return {
        type: FETCH_TVS_SUCCESS,
        payload
    }
}

function fetchTvsFailure(payload) {
    return {
        type: FETCH_TVS_FAILURE,
        payload
    }
}

export function handleLoadingTvs() {
    return function (dispatch) {
        dispatch(fetchTvsRequest());

        return fetch(`${config.server}/api/tvs`)
            .then(res => res.json())
            .then(json => dispatch(fetchTvsSuccess(json)))
            .catch(err => dispatch(fetchTvsFailure(err)));
    }
}
