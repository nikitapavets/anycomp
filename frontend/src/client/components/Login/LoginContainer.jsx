import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleLogin} from '../../actions/users';
import LoginPage from './LoginPage';

const mapStateToProps = (state) => {
    return {
        users: state.users,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLogin: bindActionCreators(handleLogin, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(LoginPage);
