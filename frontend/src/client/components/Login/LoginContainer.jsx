import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleCheckAuthUser} from '../../actions/users';
import LoginPage from './LoginPage';

const mapStateToProps = (state) => {
    return {
        users: state.users,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleCheckAuthUser: bindActionCreators(handleCheckAuthUser, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(LoginPage);
