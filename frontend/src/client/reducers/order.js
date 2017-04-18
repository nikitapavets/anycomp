import * as actionTypes from '../actions-types/order';

const INIT_STEP = 0;
const USER_STEP = 1;
const PRODUCTS_STEP = 2;

const initialState = {
    data: {},
    client: {},
    isLoading: false,
    error: false,
    stepNumber: INIT_STEP
};

export default function basket(state = initialState, action) {
    switch (action.type) {
        case actionTypes.ORDER_USER_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.ORDER_USER_SUCCESS:
            return {
                ...state,
                client: action.payload,
                isLoading: false,
                stepNumber: PRODUCTS_STEP
            };

        case actionTypes.ORDER_USER_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        case actionTypes.ORDER_PRODUCTS_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.ORDER_PRODUCTS_SUCCESS:
            return {
                ...state,
                data: action.payload,
                isLoading: false
            };

        case actionTypes.ORDER_PRODUCTS_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        case actionTypes.SET_ORDER_INIT_STEP:
            return {
                ...state,
                stepNumber: INIT_STEP
            };

        case actionTypes.SET_ORDER_USER_STEP:
            return {
                ...state,
                stepNumber: USER_STEP
            };

        default: {
            return state
        }
    }
}
