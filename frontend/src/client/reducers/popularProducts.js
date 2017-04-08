import * as actionTypes from '../actions-types/popularProducts';

const initialState = {
    data: [],
    isLoading: false,
    error: false
};

export default function popularProducts(state = initialState, action) {
    switch(action.type) {
        case actionTypes.FETCH_POPULAR_PRODUCTS_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_POPULAR_PRODUCTS_SUCCESS:
            return {
                ...state,
                data: action.payload,
                isLoading: false
            };

        case actionTypes.FETCH_POPULAR_PRODUCTS_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        default:
            return state;
    }
}