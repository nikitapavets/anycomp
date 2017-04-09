import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingNotebooks} from '../../actions/notebooks';
import {basketAddItem} from '../../actions/basket';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import NotebooksPage from './NotebooksPage';

const mapStateToProps = (state) => {
    return {
        notebooks: state.notebooks,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingNotebooks: bindActionCreators(handleLoadingNotebooks, dispatch),
        basketAddItem: bindActionCreators(basketAddItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch),
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(NotebooksPage);
