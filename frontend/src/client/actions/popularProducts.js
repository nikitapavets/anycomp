import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_POPULAR_PRODUCTS_REQUEST,
    FETCH_POPULAR_PRODUCTS_SUCCESS,
    FETCH_POPULAR_PRODUCTS_FAILURE
} from '../actions-types/popularProducts';

function fetchPopularProductsRequest() {
    return {
        type: FETCH_POPULAR_PRODUCTS_REQUEST
    }
}

function fetchPopularProductsSuccess(payload) {
    return {
        type: FETCH_POPULAR_PRODUCTS_SUCCESS,
        payload
    }
}

function fetchPopularProductsFailure(payload) {
    return {
        type: FETCH_POPULAR_PRODUCTS_FAILURE,
        payload
    }
}

export function handleLoadingPopularProducts() {
    return function (dispatch) {
        dispatch(fetchPopularProductsRequest());

        return fetch(`${config.server}/api/catalog/popular`)
            .then(res => res.json())
            .then(json => dispatch(fetchPopularProductsSuccess(json)))
            .catch(err => dispatch(fetchPopularProductsFailure(err)));
    }
}
