import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {basketAddItem} from '../../actions/basket';
import {handleNotebookGet} from '../../actions/notebooks';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import NotebookPage from './NotebookPage';

const mapStateToProps = (state) => {
    return {
        notebook: state.notebooks,
        breadcrumbs: state.breadcrumbs
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        basketAddItem: bindActionCreators(basketAddItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch),
        handleNotebookGet: bindActionCreators(handleNotebookGet, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(NotebookPage);
