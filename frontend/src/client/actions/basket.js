import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_BASKET_REQUEST,
    FETCH_BASKET_SUCCESS,
    FETCH_BASKET_FAILURE,
    BASKET_ADD_ITEM,
    BASKET_REMOVE_ITEM
} from '../actions-types/basket';

function fetchBasketRequest() {
    return {
        type: FETCH_BASKET_REQUEST
    }
}

function fetchBasketSuccess(payload) {
    return {
        type: FETCH_BASKET_SUCCESS,
        payload
    }
}

function fetchBasketFailure(payload) {
    return {
        type: FETCH_BASKET_FAILURE,
        payload
    }
}

export function handleLoadingBasket() {
    return function (dispatch) {
        dispatch(fetchBasketRequest());

        return fetch(`${config.server}/api/notebooks`)
            .then(res => res.json())
            .then(json => dispatch(fetchBasketSuccess(json)))
            .catch(err => dispatch(fetchBasketFailure(err)));
    }
}

export function basketAddItem(newBasketItem) {
    return {
        type: BASKET_ADD_ITEM,
        payload: newBasketItem
    }
}

export function basketRemoveItem(basketItemIndexForRemove) {
    return {
        type: BASKET_REMOVE_ITEM,
        payload: basketItemIndexForRemove
    }
}
