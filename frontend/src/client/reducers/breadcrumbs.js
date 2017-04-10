import * as actionTypes from '../actions-types/breadcrumbs';

const initialState = [
    {
        title: '',
        link: '/'
    }
];

export default function basket(state = initialState, action) {
    switch (action.type) {
        case actionTypes.SET_BREADCRUMBS:
            return [
                ...initialState,
                ...action.payload
            ];

        default: {
            return state
        }
    }
}
