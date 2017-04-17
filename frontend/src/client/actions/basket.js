import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import cookie from 'react-cookie'

import * as cookieParams from "../config/cookie";
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

export function handleLoadingBasket() {
    return function (dispatch) {
        dispatch(fetchBasketRequest());
        const basket = cookie.load(cookieParams.BASKET_COOKIE);
        if (basket) {
            dispatch(fetchBasketSuccess(basket));
        } else {
            dispatch(fetchBasketFailure());
        }
    }
}
