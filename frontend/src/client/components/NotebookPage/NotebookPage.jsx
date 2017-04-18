import React from 'react';
import CatalogItemLayout from '../CatalogItemLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Ноутбуки',
                link: '/notebooks'
            }
        ]);

        this.props.handleNotebookGet(this.props.params.id);
    }

    render() {
        return (
            <div>
                <CatalogItemLayout {...this.props} item={this.props.notebooks}/>
            </div>
        )
    }
}
