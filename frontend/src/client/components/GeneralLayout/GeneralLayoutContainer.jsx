import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingBasket, basketRemoveItem} from '../../actions/basket';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import GeneralLayout from './GeneralLayout';

const mapStateToProps = (state) => {
    return {
        basket: state.basket,
        breadcrumbs: state.breadcrumbs
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingBasket: bindActionCreators(handleLoadingBasket, dispatch),
        basketRemoveItem: bindActionCreators(basketRemoveItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(GeneralLayout);
