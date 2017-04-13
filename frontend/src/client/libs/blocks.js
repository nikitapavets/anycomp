import styled from 'styled-components';
import {media} from './mixins';

export const Container = styled.div`
    max-width: 750px;
    margin: 0 auto;
    padding: 0 15px;
    ${media.desktop`
        max-width: 970px;
    `}
    ${media.wide`
        max-width: 1170px;
    `}
`;
