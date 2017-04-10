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

        this.props.handleNotebookGet({
            brand: this.props.params.brand,
            model: this.props.params.model,
            config: this.props.location.query.config
        });
    }

    render() {
        return (
            <div>
                <CatalogItemLayout {...this.props} item={this.props.notebooks}/>
            </div>
        )
    }
}
