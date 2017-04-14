import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingBasket, basketRemoveItem} from '../../actions/basket';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleCheckAuthUser, handleLogout} from '../../actions/users';
import GeneralLayout from './GeneralLayout';

const mapStateToProps = (state) => {
    return {
        basket: state.basket,
        breadcrumbs: state.breadcrumbs,
        users: state.users
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingBasket: bindActionCreators(handleLoadingBasket, dispatch),
        handleCheckAuthUser: bindActionCreators(handleCheckAuthUser, dispatch),
        handleLogout: bindActionCreators(handleLogout, dispatch),
        basketRemoveItem: bindActionCreators(basketRemoveItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(GeneralLayout);
